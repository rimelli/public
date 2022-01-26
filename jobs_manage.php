<?php
include("includes/header.php");


$user_jobs_query = $con->prepare("SELECT * FROM jobs WHERE user_id=? AND job_deleted = ? ORDER BY id DESC");
$user_jobs_query->execute([$userLoggedIn, 'no']);

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
				<h3>Manage Jobs</h3>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-business-center"></i> My Job Listings</h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
								<?php while ($row = $user_jobs_query->fetch()) { 									
									$post_date = date('d F, Y', strtotime($row['job_post_date']));							
									$exp_date = $row['job_exp_date'] != '0000-00-00' ? date('d F, Y', strtotime($row['job_exp_date'])) : null;
									?>
									<li id="job_<?php echo $row['id']; ?>">
										<!-- Job Listing -->
										<div class="job-listing">

											<!-- Job Listing Details -->
											<div class="job-listing-details">

												<!-- Logo -->
												<!--<a href="#" class="job-listing-company-logo">
													<img src="images/company-logo-05.png" alt="">
												</a> -->

												<!-- Details -->
												<div class="job-listing-description">
													<h3 class="job-listing-title"><a href="#"><?php echo $row['job_title'];?></a> </h3>

													<!-- Job Listing Footer -->
													<div class="job-listing-footer">
														<ul>
															<li><i class="icon-material-outline-date-range"></i> Posted on <?php echo $post_date;?></li>
															<?php if ($exp_date){ ?><li><i class="icon-material-outline-date-range"></i> Expiring on <?php echo $exp_date;?></li><?php } ?>
														</ul>
													</div>
												</div>
											</div>
										</div>

										<!-- Buttons -->
										<div class="buttons-to-right always-visible">
											<a href="dashboard-manage-candidates.html" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> Manage Candidates <span class="button-info">0</span></a>
											<a href="jobs_edit.php?id=<?php echo $row['id']; ?>" class="button gray ripple-effect ico" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
											<a href="#" data-job_id="<?php echo $row['id']; ?>" class="button gray ripple-effect ico job-deletion" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2" data-job_id="<?php echo $row['id']; ?>"></i></a>
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

<!-- Job Delete -->
<div id="job-post-overlay"></div>
<div id="job-post-delete">	
	<i class="fas fa-question"></i>
	<ul>
		<li>Are you sure you want to delete the job #170?</li>
		<li><a href="#">YES</a><a href="#">NO</a></li>
	</ul>		
</div>


<!-- Scripts
================================================== -->
<script src="assets/js/mmenu.min.js"></script>
<script src="assets/js/tippy.all.min.js"></script>
<script src="assets/js/simplebar.min.js"></script>
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


