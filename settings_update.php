<?php
require 'config/config.php';

if (isset($_SESSION['user_id'])) {
	$userLoggedIn = $_SESSION['user_id'];
	$user_details_query = $con->prepare("SELECT * FROM users WHERE user_id=?");
	$user_details_query->execute([$userLoggedIn]);
	$user = $user_details_query->fetch();

	$individual_user_details_query = $con->prepare("SELECT * FROM individuals WHERE user_id=?");
	$individual_user_details_query->execute([$userLoggedIn]);
	$individual_user = $individual_user_details_query->fetch();	
	
}
else {
	header("Location: home.php");
	exit();
}

include("includes/form_handlers/settings_handler.php");
?>