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
				<h3>Teams</h3>
			</div>

			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">
						<div class="headline">
							<h3><i class="icon-feather-shield"></i> Your Teams</h3>
						</div>
						<div class="content">

						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->

			<div class="row" id="teams-container">
			<?php
				$sql = $con->prepare("SELECT * FROM teams WHERE user_id=? AND team_deleted = ?");
				$sql->execute([$userLoggedIn, 'no']);
			  	$teams = $sql->fetchAll();
			?>
			<?php foreach ($teams as $team): 
			$team_id = $team['team_id'];
			$sql = $con->prepare("SELECT * FROM team_players WHERE team_id=? AND player_deleted=?");
			$sql->execute([$team_id, 'no']);
		  	$players_count = $sql->rowCount();
			?>
			<div class="col-xl-3" id="team_<?php echo $team_id; ?>">
				<div class="companies-list">
					<a href="team_page.php?id=<?php echo $team_id; ?>" class="company">
						<div class="company-inner-alignment">
							<h4 class="margin-bottom-10"><?php echo $team['team_name'] ?></h4>
							<span class="company-not-rated"><?php echo $players_count; ?> Players</span>
						</div>
					</a>
				</div>
			</div>
			<?php endforeach ?>
			</div>

			<div class="row">
				<div class="col-xl-12">
					
					<h3 class="margin-top-35 margin-bottom-30">Add Team</h3>

					<!-- Form -->
					<form class="add-teams-form" method="POST" style="display: contents;" id="add-teams-form">
					<input type="hidden" name="add_team" value="1" />

						<div class="row">
							<div class="col-xl-6">
								<div class="input-with-icon-left no-border">
									<i class="icon-feather-shield"></i>
									<input type="text" class="input-text" name="team_name" placeholder="Team Name" required/>
								</div>
							</div>
						</div>

						<div class="return-message"></div>
						<button class="btn btn-primary ripple-effect save-details" type="submit">											
							<i class="fas fa-sync fa-lg fa-spin margin-right-10"></i>
							<i class="fas icon-material-outline-add fa-lg margin-right-10"></i>
							<span class="text save-changes-text">Add Team</span>
						</button>
					</form>
					
				</div>
			</div>

			<div class="row">
				<div class="col-xl-6">
					<h3 class="margin-top-35 margin-bottom-30">Remove Team</h3>
					<form class="remove-team-form" method="POST" style="display: contents;" id="remove-team-form">
					<input type="hidden" name="remove_team" value="1" />
					<div class="submit-field">
						<select class="selectpicker with-border" name="team_id" data-size="3" title="Choose Team to Remove" required>
							<?php foreach ($teams as $team): ?>
								<option value="<?php echo $team['team_id']; ?>"><?php echo $team['team_name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<button class="btn btn-primary ripple-effect save-details" type="submit">											
						<i class="fas fa-sync fa-lg fa-spin margin-right-10"></i>
						<i class="fas icon-feather-trash-2 fa-lg margin-right-10"></i>
						<span class="text save-changes-text">Remove Team</span>
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