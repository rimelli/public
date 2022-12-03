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
		<div class="dashboard-content-inner" >
	
			<!-- Row -->
			<div class="row">

				<?php

					$user_data_query = $con->prepare("SELECT first_name, last_name, email FROM users WHERE user_id=?");
					$user_data_query->execute([$userLoggedIn]);
					$row = $user_data_query->fetch();

					$first_name = $row['first_name'];
					$last_name = $row['last_name'];
					$email = $row['email'];
					$username = $user['username'];
					$prof_type = $user['profile_type'];
				?>


					<?php
					$child_query = $con->prepare("SELECT * FROM children WHERE parent_id=? AND child_deleted=? ORDER BY child_id DESC");
					$child_query->execute([$userLoggedIn, 'no']);
					$child_result = $child_query->fetchAll();
					?>
					<div class="col-xl-12">
					<div class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-face"></i> Child Profile</h3>
						</div>

						<div class="content with-padding padding-bottom-0" id="child-container">
							<?php foreach ($child_result as $child): 
								$child_id = $child['child_id'] ?>
								<div class="attachment-box ripple-effect" id="child_<?php echo $child_id; ?>" style="display: inline-grid;">
									<p><?php echo $child['first_name_child'] . ' ' . $child['last_name_child'] ?></p>
									<a href="#" data-id="<?php echo $child_id; ?>" class="remove-child">
		                              <i class="icon-feather-trash-2 remove-child" data-id="<?php echo $child_id; ?>" id="del_<?php echo $child_id; ?>" title="Remove" data-tippy-placement="left"></i>
		                            </a>
	                            </div>
							<?php endforeach ?>
							<div id="child-deleted-message"></div>

							<div class="row">

								<form class="child-form" method="POST" id="child-form" style="display: contents;">
								<input type="hidden" name="update_child" value="1" />
								<div class="col">
									<div class="row">

										<div class="col-xl-12">
											<div class="submit-field">
												<h5>Add Child Profile</h5>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>First Name</h5>
												<input type="text" name="first_name_child" class="with-border" value="" autocomplete="off" required>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Last Name</h5>
												<input type="text" name="last_name_child" class="with-border" value="" autocomplete="off" required >
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Gender</h5>
												<select class="selectpicker with-border" id="gender_child" name="gender_child" data-size="7" required>
													<option value="" selected>Select Child's Gender</option>
													<option value="M">Male</option>
													<option value="F">Female</option>
												</select>
											</div>
										</div>

									</div>
								</div>

									<!-- Button -->
									<div class="col-xl-12 mb-4 save-submit">
										<div class="return-message"></div>
										<button class="btn btn-primary ripple-effect save-details" type="submit">											
											<i class="fas fa-sync fa-lg fa-spin margin-right-10"></i>
											<i class="fas icon-material-outline-add fa-lg margin-right-10"></i>
											<span class="text save-changes-text">Add Child</span>
										</button>										
									</div>
								</form>
									
								
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

<script src="assets/js/front/hs.core.js"></script>
<script src="assets/js/front/hs.select2.js"></script>




</body>
</html>