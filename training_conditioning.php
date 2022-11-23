<?php
include("includes/header.php");
include("includes/form_handlers/sess_handler.php");
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
				<h3>Training Centre - Conditioning</h3>
				<div class="blog-post-info-list"><a href="training.php" class="blog-post-info"><i class="icon-feather-arrow-left margin-right-5"></i>Back to Training Centre</a></div>
			</div>

			<!-- Row -->
			<div class="row">

				<!-- Section -->
<div class="section gray">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8">
				<?php 
 				if(isset($training_drills)){
 				foreach($training_drills as $tr_drill){

 				?>

				<!-- Blog Post -->
				<a class="blog-post">
					<!-- Blog Post Content -->
					<div class="blog-post-content">
 						<h3><?= $tr_drill['tr_name']?></h3>
 						<p><?= $tr_drill['tr_description']?></p>
 					</div>
 					<!-- Icon -->
 					<div class="entry-icon"></div>
 				</a>
 					<?php }
 				}else{
 					?>
 									<a class="blog-post">
 										<div class="blog-post-content">
						<?php
						$q = $con->prepare("SELECT * FROM training_sessions WHERE user_id=? and session_completed='yes'");
						$q->execute([$userLoggedIn]);
						$rating_result = $q->fetchAll();
					  	$rating_count = $q->rowCount();
					  	if ($rating_count < 10) {
					  		echo "<div class='star-rating' data-rating='1.0'>
							  Complete ". 10-$rating_count ." more sessions to start updating your rating
									</div>";
					  	} elseif ($rating_count> 10) {
					  		echo "<div class='star-rating' data-rating='". getRating($con,$userLoggedIn)."'>
									</div>";
					  	}
						?>
						<h3>Conditioning</h3>
						<p>Conditioning is about preparing the player's body and mind to achieve full potential, as well as improving recovery times and resistance to injury, allowing them to meet the tough demands of the game, especially at top levels.</p>
					</div>
					<!-- Icon -->
					<div class="entry-icon"></div>
				</a>
				<?php } ?>

			</div>


			<div class="col-xl-4 col-lg-4 content-left-offset">
				<div class="sidebar-container">

					<!-- Widget -->
					<div class="sidebar-widget" id="session-container">
						<h3>Current Session</h3>
						<?php
							$sql = $con->prepare("SELECT * FROM training_sessions WHERE user_id=? AND session_deleted=? AND session_completed=? ORDER BY id DESC");
							$sql->execute([$userLoggedIn, 'no', 'no']);
						  	$res = $sql->fetchAll();
						  	$res_count = $sql->rowCount();

						  	if ($res_count == 0) {
						  		echo "
 								  <div id='current-session-container'>
 								  <p>No current session</p>
 								  </div>
 								";
						  	}
						  	elseif ($res_count > 0) {
						  		foreach ($res as $sess) {
						  		echo "<div id='current-session-container'><ul class='widget-tabs margin-bottom-30'>
										<li>
											<a href='training_page.php?training_session_id=".$sess['id']."' class='widget-content active'>
												<img src='assets/images/conditioning.jpg' alt=''>
												<div class='widget-text'>
													<h5>Conditioning</h5>
												</div>
											</a>
										</li>
									</ul></div>";
						  		}
						  	}
						  	
						?>

						<h3>Last Sessions</h3>
						<?php
							$sql = $con->prepare("SELECT * FROM training_sessions WHERE user_id=? AND session_deleted=? AND session_completed=? ORDER BY id DESC");
							$sql->execute([$userLoggedIn, 'no', 'yes']);
						  	$res = $sql->fetchAll();
						  	$res_count = $sql->rowCount();

						  	if ($res_count == 0) {
						  		echo "
 								  <div id='last-session-container'>
 								  <p>No last sessions</p>
 								  </div>
 								";
						  	}
						  	elseif ($res_count > 0) {
						  		foreach ($res as $sess) {
						  		echo "<div id='last-session-container'><ul class='widget-tabs margin-bottom-30'>
										<li>
											<a href='training_page.php?training_session_id=".$sess['id']."' class='widget-content active'>
												<img src='assets/images/conditioning.jpg' alt=''>
												<div class='widget-text'>
													<h5>Conditioning</h5>
												</div>
											</a>
										</li>
									</ul>
									</div>";
						  		}
						  	}
						  	
						?>

					</div>
					<!-- Widget / End-->

				</div>
			</div>

		</div>
	</div>
	</div>
			</div>
			<!-- Row / End -->

			<div class="row">
				<div class="col-xl-12">

					<!-- Form -->
					<form class="create-session-form" method="POST" style="display: contents;" id="create-session-form">
					<input type="hidden" name="create_session_cond" value="1" />

						<div class="return-message"></div>
						<button class="btn btn-primary ripple-effect save-details" type="submit">											
							<i class="fas fa-sync fa-lg fa-spin margin-right-10"></i>
							<i class="fas icon-material-outline-add fa-lg margin-right-10"></i>
							<span class="text save-changes-text">Create Session</span>
						</button>
					</form>
					
				</div>
			</div>

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