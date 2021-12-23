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
<link rel="stylesheet" href="assets/css/custom.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">

</head>
<body>


<!-- Intro Banner
================================================== -->
<!-- add class "disable-gradient" to enable consistent background overlay -->
<div class="intro-banner">
	<div class="container">
		
		<!-- Intro Headline -->
		<div class="row">
			<div class="col-md-6">
				<!-- Logo -->
					<a href="home.php"><h1>Home</h1></a>
			</div>

			<div class="col-md-6">
				<div class="login-div home-form-div">
					<div class="login-headline">
						<h3>Sign In</h3>
					</div>
						
					<!-- Form -->
					<form action="" class="login-form-style" id="login-form">
					<div id="responselogin"></div>
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
						<a href="#" class="forgot-password">Forgot Password?</a>

						<!-- Button -->
						<div>
							<button class="button login-form-btn button-sliding-icon ripple-effect margin-top-10 margin-bottom-30 spin" id="login_button">Log In <i class="icon-material-outline-arrow-right-alt"></i></button>
						</div>
					</form>
					
					

					<div class="account-type">
                      <div>
                        <input type="radio" name="account-type-radio" id="login-radio" class="account-type-radio"/>
                        <label for="login-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i>Don't have an account? <span class="login-form-label">Sign Up!</span></label>
                      </div>
                	</div>
				</div>


				<div class="register-div home-form-div">
					<div class="login-headline">
						<h3>Register</h3>
					</div>

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
				<form action=""class="login-form-style" id="register-account-form">
				<div id="responseregister"></div>
					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="reg_fname" id="firstname-register" placeholder="First Name" value="<?php 
                            if(isset($_SESSION['reg_fname'])) {
                                echo $_SESSION['reg_fname'];
                            } 
                            ?>" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="reg_lname" id="lastname-register" placeholder="Last Name" value="<?php 
                            if(isset($_SESSION['reg_lname'])) {
                                echo $_SESSION['reg_lname'];
                            } 
                            ?>" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="reg_email" id="emailaddress-register" placeholder="Email Address" value="<?php 
                            if(isset($_SESSION['reg_email'])) {
                                echo $_SESSION['reg_email'];
                            } 
                            ?>" required/>
					</div>

					<div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="reg_password" id="password-register" placeholder="Password" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="reg_password2" id="password-repeat-register" placeholder="Repeat Password" required/>
					</div>

					<!-- Button -->
					<div>
						<button class="button login-form-btn button-sliding-icon ripple-effect margin-top-10 margin-bottom-30" id="register_button">Register <i class="icon-material-outline-arrow-right-alt"></i></button>
					</div>
				</form>

					<div class="account-type">
                      <div>
                        <input type="radio" name="account-type-radio" id="register-radio" class="account-type-radio"/>
                        <label for="register-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i>Already have an account? <span class="login-form-label">Log In!</span></label>
                      </div>
                	</div>
				</div>

				

			</div>

		</div>

		

	</div>
</div>





<!-- Scripts
================================================== -->
<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/jquery-migrate-3.3.1.min.js"></script>
<script src="assets/js/xhr/jquery.form.min.js"></script>
<script src="assets/js/xhr/jquery.validate.min.js"></script>
<script src="assets/js/xhr/login.js"></script>
<script src="assets/js/xhr/register.js"></script>
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