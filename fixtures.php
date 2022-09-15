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
<link rel="stylesheet" href="assets/vendor/flatpickr/dist/flatpickr.css">

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
				<h3>Fixtures</h3>
			</div>

			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">
						<div class="headline">
							<h3><i class="icon-feather-calendar"></i> Your Fixtures</h3>
						</div>
						<div class="content">

						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->

			<div class="row" id="fixtures-container">
			<?php
				$sql = $con->prepare("SELECT * FROM fixtures WHERE user_id=? AND fixture_deleted=?");
				$sql->execute([$userLoggedIn, 'no']);
			  	$fixtures = $sql->fetchAll();
			?>
			<?php foreach ($fixtures as $fixture): 
			$your_team = $fixture['your_team'];
			$sql = $con->prepare("SELECT team_name FROM teams WHERE team_id=? AND team_deleted=?");
			$sql->execute([$your_team, 'no']);
		  	$team_name = $sql->fetchColumn();
		  	$sql = $con->prepare("SELECT first_name, last_name FROM users WHERE user_id=? AND user_closed=?");
			$sql->execute([$fixture['other_team_id'], 'no']);
		  	$other_team = $sql->fetch();
			?>
			<div class="col-xl-3" id="fixture_<?php echo $fixture['id']; ?>">
				<div class="companies-list">
					<a href="live_match.php?id=<?php echo $fixture['id']; ?>" class="company">
						<div class="company-inner-alignment">
							<h4 class="margin-bottom-10"><?php echo $team_name; ?></h4><span>X</span><h4 class="margin-bottom-10"><span class="company-not-rated"><?php echo $fixture['other_team_name']; ?></span></h4>
						</div>
					</a>
				</div>
			</div>
			<?php endforeach ?>
			</div>

			<div class="row">
				<div class="col-xl-12">
					
					<h3 class="margin-top-35 margin-bottom-30">Add Fixture</h3>
					<?php
						$sql = $con->prepare("SELECT * FROM teams WHERE user_id=? AND team_deleted = ?");
						$sql->execute([$userLoggedIn, 'no']);
					  	$teams = $sql->fetchAll();
					?>

					<!-- Form -->
					<form class="add-fixture-form" method="POST" style="display: contents;" id="add-fixture-form">
					<input type="hidden" name="add_fixture" value="1" />

						<div class="row">
							<div class="col-xl-6">
								<div class="submit-field">
									<div>
										<div class="section-headline margin-bottom-12">
											<h5>Is your team playing Home or Away?</h5>
										</div>
										<div class="checkbox form-control">
											<input type="radio" name="home_away" value="home" id="checkbox_home" required>
											<label for="checkbox_home"><span class="checkbox-icon"></span> Home</label>
										</div>
										<div class="checkbox form-control">
											<input type="radio" name="home_away" value="away" id="checkbox_away" required>
											<label for="checkbox_away"><span class="checkbox-icon"></span> Away</label>
										</div>
									</div>
			                    </div>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-6">
								<div class="submit-field">
									<select class="selectpicker with-border" name="team_id" data-size="3" title="Select Your Team" required>
										<?php foreach ($teams as $team): ?>
											<option value="<?php echo $team['team_id']; ?>"><?php echo $team['team_name']; ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Fixture Date</h5>
									<!-- Flatpickr -->

			                            <input type="date" value="" class="flatpickr-custom-form-control form-control with-border input" name="fixture_date" placeholder="Select Fixture Date" id="eventDate" data-input required>
			                          
			                        <!-- End Flatpickr -->
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-6">
								<div class="input-with-icon-left no-border">
									<i class="icon-feather-shield"></i>
									<input type="text" class="input-text" name="other_team" placeholder="Other Team" id="other_team" required/>
									<div id="live-search-results"></div>
								</div>
							</div>
						</div>

						<div class="return-message"></div>
						<button class="btn btn-primary ripple-effect save-details" type="submit">											
							<i class="fas fa-sync fa-lg fa-spin margin-right-10"></i>
							<i class="fas icon-material-outline-add fa-lg margin-right-10"></i>
							<span class="text save-changes-text">Add Fixture</span>
						</button>
					</form>
					
				</div>
			</div>

			<div class="row">
				<div class="col-xl-6">
					<h3 class="margin-top-35 margin-bottom-30">Remove Fixture</h3>
					<form class="remove-fixture-form" method="POST" style="display: contents;" id="remove-fixture-form">
					<input type="hidden" name="remove_fixture" value="1" />
					<div class="submit-field">
						<select class="selectpicker with-border" name="fixture_id" data-size="3" title="Choose Fixture to Remove" required>
							<?php foreach ($fixtures as $fixture): 
								$your_team = $fixture['your_team'];
								$sql = $con->prepare("SELECT team_name FROM teams WHERE team_id=? AND team_deleted=?");
								$sql->execute([$your_team, 'no']);
							  	$team_name = $sql->fetchColumn();
							  	$sql = $con->prepare("SELECT first_name, last_name FROM users WHERE user_id=? AND user_closed=?");
								$sql->execute([$fixture['other_team_id'], 'no']);
							  	$other_team = $sql->fetch();
							  	?>
								<option value="<?php echo $fixture['id']; ?>"><?php echo $team_name . ' x ' . $fixture['other_team_name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<button class="btn btn-primary ripple-effect save-details" type="submit">											
						<i class="fas fa-sync fa-lg fa-spin margin-right-10"></i>
						<i class="fas icon-feather-trash-2 fa-lg margin-right-10"></i>
						<span class="text save-changes-text">Remove Fixture</span>
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
<script src="assets/vendor/flatpickr/dist/flatpickr.min.js"></script>
<script src="assets/js/front/hs.flatpickr.js"></script>

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

<script>

	$('#eventDate').flatpickr({
	enableTime: true,
	static: true,
	altInput: true,
	altFormat: "F j, Y H:i:s",
	dateFormat: "Y-m-d H:i:s",
	minDate: "today"
});

</script>


<script>
	$(document).ready(function(){
	    /// Live Search ///
	    $("#other_team").keyup(function(){

	        var query = $(this).val();
	        if (query !="") {
	            $.ajax({
	                url:"includes/handlers/live_search.php",
	                type:"POST",
	                cache:false,
	                data:{query:query},
	                success:function(data){

	                    $("#live-search-results").html(data);
	                    $('#live-search-results').css('display', 'block');

	                    /// Click to enter result ///
	                    $("#live-search-results a").on("click", function(){
	                        $("#other_team").val($(this).html());
	                        $("#live-search-results").css('display', 'none');
	                    });
	                }

	            });
	        }

	        else {
	            $("#live-search-results").html("");
	            $('#search-results-box').css('display', 'none');
	        }

	    });

	});
</script>

</body>
</html>