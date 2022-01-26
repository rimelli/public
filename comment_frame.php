<?php  
	require 'config/config.php';
	include("includes/classes/User.php");
	include("includes/classes/Post.php");
	include("includes/classes/Notification.php");

	if (isset($_SESSION['user_id'])) {
		$userLoggedIn = $_SESSION['user_id'];
		$user_details_query = $con->prepare("SELECT * FROM users WHERE user_id=?");
		$user_details_query->execute([$userLoggedIn]);
		$user = $user_details_query->fetch();
	}
	else {
		header("Location: home.php");
	}

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<style type="text/css">
	* {
		font-size: 14px;
		font-family: Arial, Helvetica, Sans-serif;
	}	

	</style>

	<script>
		function toggle() {
			var element = document.getElementById("comment_section");

			if(element.style.display == "block")
				element.style.display = "none";
			else
				element.style.display = "block";
		}
	</script>

	<?php 
	//Get id of post
	if(isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];
	}

	$user_query = $con->prepare("SELECT added_by, user_to FROM posts WHERE id=?");
	$user_query->execute([$post_id]);
	$row = $user_query->fetch();

	$posted_to = $row['added_by'];
	$user_to = $row['user_to'];

	if(isset($_POST['postComment' . $post_id])) {
		$post_body = $_POST['post_body'];
		$date_time_now = date("Y-m-d H:i:s");
		$insert_post = $con->prepare("INSERT INTO comments VALUES (NULL, ?, ?, ?, ?, 'no', ?)");
		$insert_post->execute([$post_body, $userLoggedIn, $posted_to, $date_time_now, $post_id]);
		
		if($posted_to != $userLoggedIn) {
			$notification = new Notification($con, $userLoggedIn);
			$notification->insertNotification($post_id, $posted_to, "comment");
		}

		if($user_to != 'none' && $user_to != $userLoggedIn) {
			$notification = new Notification($con, $userLoggedIn);
			$notification->insertNotification($post_id, $user_to, "profile_comment");
		}


		$get_commenters = $con->prepare("SELECT * FROM comments WHERE post_id=?");
		$get_commenters->execute([$post_id]);
		$notified_users = array();
		while($row = $get_commenters->fetch()) {

			if($row['posted_by'] != $posted_to && $row['posted_by'] != $user_to
				&& $row['posted_by'] != $userLoggedIn && !in_array($row['posted_by'], $notified_users)) {

				$notification = new Notification($con, $userLoggedIn);
				$notification->insertNotification($post_id, $row['posted_by'], "comment_non_owner");

				array_push($notified_users, $row['posted_by']);

			}


		}



		echo "<p>Comment posted! </p>";
	}




	 ?>
	 <form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
	 	<textarea name="post_body" required></textarea>
	 	<input type="submit" name="postComment<?php echo $post_id; ?>" value="Post">
	 </form>

	 <!-- Load comments -->
	 <?php 
	 $get_comments = $con->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id ASC");
	 $get_comments->execute([$post_id]);
	 $count = $get_comments->rowCount();

	 if ($count != 0) {

	 	while($comment = $get_comments->fetch()) {

	 		$comment_body = $comment['post_body'];
	 		$posted_to = $comment['posted_to'];
	 		$posted_by = $comment['posted_by'];
	 		$date_added = $comment['date_added'];
	 		$removed = $comment['removed'];

	 		//Timeframe
			$date_time_now = date("Y-m-d H:i:s");
			$start_date = new DateTime($date_added); //Time of post
			$end_date = new DateTime($date_time_now); //Current time
			$interval = $start_date->diff($end_date); //Difference between dates
			if($interval->y >= 1) {
				if($interval == 1)
					$time_message = $interval->y . " year ago"; //1 year ago
				else
					$time_message = $interval->y . " years ago"; //1+ year ago
			}
			elseif ($interval-> m >= 1) {
				if($interval->d == 0) {
					$days = " ago";
				}
				else if($interval->d == 1) {
					$days = $interval->d . " day ago";
				}
				else {
					$days = $interval->d . " days ago";
				}


				if ($interval->m == 1) {
					$time_message = $interval->m . " month". $days;
				}
				else {
					$time_message = $interval->m . " months". $days;
				}

			}
			else if($interval->d >= 1) {
				if($interval->d == 1) {
					$time_message = "Yesterday";
				}
				else {
					$time_message = $interval->d . " days ago";
				}
			}
			else if($interval->h >= 1) {
				if($interval->h == 1) {
					$time_message = $interval->h . " hour ago";
				}
				else {
					$time_message = $interval->h . " hours ago";
				}
			}
			else if($interval->i >= 1) {
				if($interval->i == 1) {
					$time_message = $interval->i . " minute ago";
				}
				else {
					$time_message = $interval->i . " minutes ago";
				}
			}
			else {
				if($interval->s < 30) {
					$time_message = "Just now";
				}
				else {
					$time_message = $interval->s . " seconds ago";
				}
			}

			$user_obj = new User($con, $posted_by);

			?>
			<div class="comment_section">
			 	<a href="<?php echo $posted_by?>" target="_parent"><img src="<?php echo $user_obj->getProfilePic();?>" title="<?php echo $posted_by; ?>" style="float:left;" height="30"></a>
			 	<a href="<?php echo $posted_by?>" target="_parent"> <b> <?php echo $user_obj->getFirstAndLastName(); ?> </b></a>
			 	&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $time_message . "<br>" . $comment_body; ?>
			 	<hr>
			 </div>
			<?php

	 	}

	 }
	 else {
	 	echo "<center><br><br>No comments to show!</center>";
	 }

	 ?>






</body>
</html>