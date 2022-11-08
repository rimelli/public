<?php
include("includes/header.php");


if(isset($_GET['training_session_id'])){
 	$session_id=preg_replace("/[^0-9]/", "",$_GET['training_session_id']);
 	$sql=$con->prepare("SELECT * FROM training_sessions WHERE id=?");
 	$sql->execute([$session_id]);
 	$tr_session = $sql->fetch(PDO::FETCH_ASSOC);
 	$drills=$tr_session['session_drill_1'].','.$tr_session['session_drill_2'].','.$tr_session['session_drill_3'].','.$tr_session['session_drill_4'].','.$tr_session['session_drill_5'];
 	$training_query=$con->prepare("SELECT * from training WHERE id IN ($drills)");
 	$training_query->execute();

 	$training_drills=$training_query->fetchAll(PDO::FETCH_ASSOC);
 } else{
 	header("Location: training.php");
 }
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
				<h3>Training Session</h3>
				<div class="blog-post-info-list"><a href="training_<?php echo $tr_session['session_category']; ?>.php" class="blog-post-info"><i class="icon-feather-arrow-left margin-right-5"></i>Back to <?php echo $tr_session['session_category']; ?></a></div>
			</div>

			<!-- Row -->
			<div class="row">

				<!-- Section -->
<div class="section gray">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8">
				<?php 
 				foreach($training_drills as $tr_drill){
 				?>
				<a class="blog-post">
					<div class="blog-post-content">
 						<h3><?= $tr_drill['tr_name']?></h3>
 						<p><?= $tr_drill['tr_description']?></p>
 						<div class="checkbox form-control" style="display: inline-table;">
 							<h4>Completed?</h4>
							<input type="radio" name="sess_complete_<?= $tr_drill['id']?>" value="yes" id="sess_complete_yes_<?= $tr_drill['id']?>">
							<label for="sess_complete_yes_<?= $tr_drill['id']?>"><span class="checkbox-icon"></span> Yes</label>
							<input type="radio" name="sess_complete_<?= $tr_drill['id']?>" value="no" id="sess_complete_no_<?= $tr_drill['id']?>">
							<label for="sess_complete_no_<?= $tr_drill['id']?>"><span class="checkbox-icon"></span> No</label>
						</div>
 					</div>
 					<!-- Icon -->
 					<div class="entry-icon"></div>
 				</a>
 				<?php } ?>

			</div>

		</div>
	</div>
	</div>
			</div>
			<!-- Row / End -->

			<div class="row">
				<div class="col-xl-12">

					<!-- Form -->
					<form class="finish-session-form" method="POST" style="display: contents;" id="finish-session-form">
					<input type="hidden" name="finish_session_cond" value="1" />

						<div class="return-message"></div>

						<button class="btn btn-primary ripple-effect save-details" type="submit">											
							<i class="fas fa-sync fa-lg fa-spin margin-right-10"></i>
							<i class="fas icon-material-outline-check fa-lg margin-right-10"></i>
							<span class="text save-changes-text">Finish Session</span>
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