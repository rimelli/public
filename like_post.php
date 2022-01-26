<?php  
	require 'config/config.php';
 
	if (isset($_SESSION['username'])) {
		$userLoggedIn = $_SESSION['username'];
		$user_details_query = $con->prepare("SELECT * FROM users WHERE username=?");
		$user_details_query->execute([$userLoggedIn]);
		$user = $user_details_query->fetch();
	}
	else {
		header("Location: home.php");
	}
 
	//Get id of post
	if(isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];
	}
 
	$get_likes = $con->prepare("SELECT * FROM likes WHERE post_id=?");
	$get_likes->execute([$post_id]);
	$total_likes = $get_likes->rowCount();
        echo json_encode($total_likes);
?>