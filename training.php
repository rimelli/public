<?php
include("includes/header.php");
include("includes/form_handlers/training_handler.php");
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

				<a href='#small-dialog' class='button ripple-effect margin-top-20 popup-with-zoom-anim'>Click here to start</a>
			</div>

			<!-- Row -->
			<div class="row">

				<!-- Section -->
<div class="section gray margin-bottom-90">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8">

				<!-- Blog Post -->
				<a href="training_conditioning.php" class="blog-post">
					<!-- Blog Post Thumbnail -->
					<div class="blog-post-thumbnail">
						<div class="blog-post-thumbnail-inner">
							<img src="" alt="">
						</div>
					</div>
					<!-- Blog Post Content -->
					<div class="blog-post-content">
						<?php
						$q = $con->prepare("SELECT * FROM ratings WHERE user_id=?");
						$q->execute([$userLoggedIn]);
						$rating_result = $q->fetchAll();
					  	$rating_count = $q->rowCount();
					  	if ($rating_count == 0) {
					  		echo "<div class='star-rating' data-rating='1.0'>
									</div>";
					  	} elseif ($rating_count == 1) {
					  		echo "<div class='star-rating' data-rating='".$rating_result['r_conditioning']."'>
									</div>";
					  	}
						?>
						<h3>Conditioning</h3>
						<p>Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning Conditioning.</p>
					</div>
					<!-- Icon -->
					<div class="entry-icon"></div>
				</a>

			</div>


			<div class="col-xl-4 col-lg-4 content-left-offset">
				<div class="sidebar-container">

					<!-- Widget -->
					<div class="sidebar-widget">
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
												<img src='' alt=''>
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


<!-- Popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content">
				<div class="login-headline">
					<h3>What's your current conditioning level?</h3>
				</div>

				<p id="cond-result" class="notification" style="display: none;"></p>

				<!-- Form -->
				<form id="cond-form" class="login-form login-form-style">
					<input type="hidden" name="cond_button" value="1" />
						<div class="radio" style="width: 100%;">
							<input id="radio-1" name="cond-radio" type="radio" value="1">
							<label for="radio-1" class="margin-bottom-10"><span class="radio-label"></span> Beginner</label>
							<input id="radio-2" name="cond-radio" type="radio" value="3">
							<label for="radio-2" class="margin-bottom-10"><span class="radio-label"></span> Intermediate</label>
							<input id="radio-3" name="cond-radio" type="radio" value="4">
							<label for="radio-3" class="margin-bottom-10"><span class="radio-label"></span> Advanced</label>
						</div>

						<span>Don't know your level? <a href="#small-dialog-1" class="popup-with-zoom-anim">Take our running test!</a></span>

					<!-- Button -->
					<button class="button login-form-btn button-sliding-icon ripple-effect margin-top-10 margin-bottom-30" type="submit" name="cond_button">Submit <i class="icon-material-outline-arrow-right-alt"></i></button>
				</form>
			</div>

		</div>
	</div>
</div>
<!-- Popup / End -->


<!-- Popup
================================================== -->
<div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="log-in">
				<div class="login-headline">
					<h3>12 minutes run test</h3>
				</div>

				<!-- Form -->
				<form id="login-form" class="login-form login-form-style">
					<input type="hidden" name="login_button" value="1" />
						<div class="radio" style="width: 100%;">
							<input id="radio-1" name="radio" type="radio">
							<label for="radio-1" class="margin-bottom-10"><span class="radio-label"></span> Excellent - Over 3 km.</label>
							<input id="radio-2" name="radio" type="radio">
							<label for="radio-2" class="margin-bottom-10"><span class="radio-label"></span> Good - 2.3 to 3 km.</label>
							<input id="radio-3" name="radio" type="radio">
							<label for="radio-3" class="margin-bottom-10"><span class="radio-label"></span> Average - 1.9 to 2.3 km.</label>
							<input id="radio-4" name="radio" type="radio">
							<label for="radio-4" class="margin-bottom-10"><span class="radio-label"></span> Below Average - 1.5 to 1.9 km.</label>
							<input id="radio-5" name="radio" type="radio">
							<label for="radio-5" class="margin-bottom-20"><span class="radio-label"></span> Poor - Below 1.5 km.</label>
						</div>

						<a href="#small-dialog" class="forgot-password popup-with-zoom-anim"><i class="icon-line-awesome-long-arrow-left"></i> Back</a>

					<!-- Button -->
					<button class="button login-form-btn button-sliding-icon ripple-effect margin-top-10 margin-bottom-30" type="submit" name="login_button">Submit <i class="icon-material-outline-arrow-right-alt"></i></button>
				</form>
			</div>

		</div>
	</div>
</div>
<!-- Popup / End -->


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

<script>
    $("#cond-form").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/form_handlers/training_handler.php',
            data: $('#cond-form').serialize(),
            success: function (data) {
                console.log(data);
                let parsedData = JSON.parse(data);

                if (parsedData.status === 'success') {
                	document.getElementById("cond-result").style.display="block";
                    $('#cond-result').text(parsedData.message).addClass('login-success');
                    console.log(`Redirecting to ${parsedData.url}`)
                    setTimeout(function () {
                        $('#cond-result').text('').removeClass('login-success');
                        window.location.href = parsedData.url;
                    }, 500);
                } else {
                	document.getElementById("cond-result").style.display="block";
                    $('#cond-result').text(parsedData.message).addClass('login-error');
                }
            }
        });
        setTimeout(function () {
        	document.getElementById("cond-result").style.display="none";
            $('#cond-result').text('').removeClass('login-error');
        });
        return false;
    });
</script>

</body>
</html>