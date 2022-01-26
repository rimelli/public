<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>



<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Home Page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">

</head>
<body>


<!-- Intro Banner
================================================== -->
<!-- add class "disable-gradient" to enable consistent background overlay -->
<div class="intro-banner" data-background-image="assets/images/home-background.jpg">
	<div class="container">
		
		<!-- Intro Headline -->
		<div class="row">
			<div class="col-md-6">
			</div>

			<a href="#small-dialog" class="button ripple-effect big margin-top-20 popup-with-zoom-anim">Log in / Sign up</a>


		</div>

		

	</div>
</div>


<!-- Log in / Sign up popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#log-in">Log in</a></li>
			<li><a href="#register">Sign up</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Log in Tab -->
			<div class="popup-tab-content" id="log-in">
				<div class="login-headline">
					<h3>Log In</h3>
				</div>

				<!-- Log in Form -->
				<form class="login-form login-form-style" method="POST">
					<input type="hidden" name="login_button" value="1" />
						<div class="input-with-icon-left">
							<i class="icon-material-baseline-mail-outline"></i>
							<input type="email" class="input-text with-border" name="log_email" id="emailaddress" placeholder="Email Address" value="<?php 
                            if(isset($_SESSION['log_email'])) {
                                echo $_SESSION['log_email'];
                            } 
                            ?>" required/>
						</div>

						<div class="input-with-icon-left">
							<i class="icon-material-outline-lock"></i>
							<input type="password" class="input-text with-border" name="log_password" id="password" placeholder="Password" required/>
						</div>

					<!-- Button -->
					<button class="button login-form-btn button-sliding-icon ripple-effect margin-top-10 margin-bottom-30" type="submit" name="login_button">Log In <i class="icon-material-outline-arrow-right-alt"></i></button>
				</form>
			</div>

			<!-- Sign up Tab -->
			<div class="popup-tab-content" id="register">
				<div class="login-headline">
					<h3>Sign Up</h3>
				</div>

				<div class="margin-bottom-10" style="text-align: center; margin: auto;"><h4 style="font-weight: 600;">Choose your profile:</h4></div>
					<!-- Account Type -->
				<div class="account-type login-form-style">
					<div>
						<input type="radio" name="reg_proftype" form="register-account-form" id="individual-radio" class="account-type-radio" value="1" checked required/>
						<label for="individual-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Individual</label>
					</div>

					<div>
						<input type="radio" name="reg_proftype" form="register-account-form" id="org-radio" class="account-type-radio" value="2"/>
						<label for="org-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Organisation</label>
					</div>
				</div>
					
				<!-- Registration Form -->
				<form class="registration-form login-form-style" method="POST" id="register-account-form">
				<input type="hidden" name="register_button" value="1" />
					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="reg_fname" placeholder="First Name" value="<?php 
                            if(isset($_SESSION['reg_fname'])) {
                                echo $_SESSION['reg_fname'];
                            } 
                            ?>" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="reg_lname" placeholder="Last Name" value="<?php 
                            if(isset($_SESSION['reg_lname'])) {
                                echo $_SESSION['reg_lname'];
                            } 
                            ?>" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="reg_email" placeholder="Email Address" value="<?php 
                            if(isset($_SESSION['reg_email'])) {
                                echo $_SESSION['reg_email'];
                            } 
                            ?>" required/>
					</div>

					<div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="reg_password" placeholder="Password" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="reg_password2" placeholder="Repeat Password" required/>
					</div>

					<!-- Button -->
					<button class="button login-form-btn button-sliding-icon ripple-effect margin-top-10 margin-bottom-30" type="submit" name="register_button">Sign Up <i class="icon-material-outline-arrow-right-alt"></i></button>
				</form>

			</div>

		</div>
	</div>
</div>
<!-- Log in / Sign up popup / End -->


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


<script>
$(".register-div").hide();
$("#register-radio").click(function() {
    if($(this).is(":checked")) {
        $(".login-div").show(300);
        $(".register-div").hide(200);
    }
});
</script>

<script>
$("#login-radio").click(function() {
    if($(this).is(":checked")) {
        $(".register-div").show(300);
        $(".login-div").hide(200);
    }
});
</script>

</body>
</html>