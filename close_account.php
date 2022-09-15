<?php 
include("includes/header.php");

if(isset($_POST['cancel'])) {
	header("Location: settings.php");
}

if(isset($_POST['close_account'])) {
	$close_query = $con->prepare("UPDATE users SET user_closed='yes' WHERE user_id=?");
	$close_query->execute([$userLoggedIn]);
	session_destroy();
	header("Location: home.php");
}
?>



<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>TRYOUTS</title>
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
				<h3>Close Account</h3><br>
				<span>Are you sure you want to close your account?<br><br>
						Closing your account will hide your profile and all your activity from other users.<br><br>
						You can re-open your account at any time by simply logging in.</span>
			</div>

			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<form action="close_account.php" method="POST">
						<input type="submit" name="cancel" id="update_details" value="No, keep it open!" class="info settings_submit">
						<input type="submit" name="close_account" id="close_account" value="Yes! Close it!" class="danger settings_submit">
					</form>
				</div>

			</div>
			<!-- Row / End -->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->


</body>
</html>

