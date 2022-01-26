<?php
include("includes/header.php");
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
				<h3>Bookmarks</h3>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-business-center"></i> Bookmarked Jobs</h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
							<?php
								$sql = $con->prepare("SELECT jobs.*, jobs.id AS job_id, users.*, nationalities.*, bookmarks.id AS bookmark_id 
													FROM jobs 
													INNER JOIN users ON jobs.user_id = users.user_id 
													INNER JOIN bookmarks ON (bookmarks.user_id = ? AND bookmarks.job_id = jobs.id) 
													LEFT JOIN nationalities ON nationalities.user_id=users.user_id 													
													WHERE users.user_closed = ? 
													AND jobs.job_deleted = ?");
								$sql->execute([$_SESSION['user_id'], 'no', 'no']);		  
								$jobs = $sql->fetchAll();	
								
								foreach ($jobs as $job) {

									$job_id = $job['job_id'];
									$date_time = $job['job_post_date'];
										//Timeframe
									$date_time_now = date("Y-m-d");
									$start_date = new DateTime($date_time); //Time of post
									$end_date = new DateTime($date_time_now); //Current time
									$interval = $start_date->diff($end_date); //Difference between dates
									if($interval->y >= 1) {
										if($interval == 1)
										$time_message = $interval->y . " year ago"; //1 year ago
										else
										$time_message = $interval->y . " years ago"; //1+ year ago
									}
									elseif ($interval->m >= 1) {
										if($interval->d == 0) {
										$days = " ago";
										}
										else if($interval->d == 1) {
										$days = $interval->d . " day ago";
										}
										else {
										$days = $interval->d . " days ago";
										}


										if ($interval->m == 1) {
										$time_message = $interval->m . " month ago";
										}
										else {
										$time_message = $interval->m . " months ago";
										}

									}
									else if($interval->d >= 1) {
										if($interval->d == 1) {
										$time_message = "Yesterday";
										}
										else {
										$time_message = $interval->d . " days ago";
										}
									}
									else if($interval->d == 0) {
										$time_message = "Today";
									}
									?>

										<li id="bookmark_<?php echo $job_id; ?>">
											<!-- Job Listing -->
											<div class="job-listing">

												<!-- Job Listing Details -->
												<div class="job-listing-details">

													<!-- Logo -->
													<div class="job-listing-company-logo">
														<img src="images/company-logo-02.png" alt="">
													</div>

													<!-- Details -->
													<div class="job-listing-description">
													<h3 class="job-listing-title"><?php echo $job['job_title']; ?></h3>

													<!-- Job Listing Footer -->
													<div class="job-listing-footer">
														<ul>
														<li><i class="icon-material-outline-business"></i> <?php echo $job['first_name'] . ' ' . $job['last_name']; ?> <?php if ($job['verified'] == "yes") echo '<div class="verified-badge" title="Verified" data-tippy-placement="top"></div>'; ?></li>
														<li><i class="icon-material-outline-location-on"></i> <?php echo $job['job_city'] . ', ' . $job['job_country']; ?></li>
														<li><i class="icon-material-outline-business-center"></i> <?php echo $job['job_category']; ?></li>
														<li><i class="icon-material-outline-access-time"></i> <?php echo $time_message; ?></li>
														</ul>
													</div>
													
												</div>												

											</div>

											<!-- Buttons -->
											<div class="buttons-to-right">
												<a href="#" data-job_id="<?php echo $job_id; ?>" class="button red ripple-effect ico bookmark-remove" title="Remove" data-tippy-placement="left">
													<i data-job_id="<?php echo $job_id; ?>" class="icon-feather-trash-2"></i>
												</a>
											</div>

										</li>											
								<?php } ?>
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

</body>
</html>

