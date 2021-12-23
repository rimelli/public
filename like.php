<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<style type="text/css">
	* {
		font-family: Arial, Helvetica, Sans-serif;
	}
	body {
		background-color: #fff;
	}

	form {
		position: absolute;
		top: 0;
	}	

	</style>


	<?php  
	require 'config/config.php';
	include("includes/classes/User.php");
	include("includes/classes/Post.php");
	include("includes/classes/Notification.php");

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

	$get_likes = $con->prepare("SELECT likes, added_by FROM posts WHERE id=?");
	$get_likes->execute([$post_id]);
	$row = $get_likes->fetch();
	$total_likes = $row['likes'];
	$user_liked = $row['added_by'];

	$user_details_query = $con->prepare("SELECT * FROM users WHERE username=?");
	$user_details_query->execute([$user_liked]);
	$row = $user_details_query->fetch();
	$total_user_likes = $row['num_likes'];

	//Like button
	if(isset($_POST['like_button'])) {
		$total_likes++;
		$query = $con->prepare("UPDATE posts SET likes=? WHERE id=?");
		$query->execute([$total_likes, $post_id]);
		$total_user_likes++;
		$user_likes = $con->prepare("UPDATE users SET num_likes=? WHERE username=?");
		$user_likes->execute([$total_user_likes, $user_liked]);
		$insert_user = $con->prepare("INSERT INTO likes VALUES(NULL, ?, ?)");
		$insert_user->execute([$userLoggedIn, $post_id]);

		//Insert notification
		if($user_liked != $userLoggedIn) {
			$notification = new Notification($con, $userLoggedIn);
			$notification->insertNotification($post_id, $user_liked, "like");
		}
	}
	//Unlike button
	if(isset($_POST['unlike_button'])) {
		$total_likes--;
		$query = $con->prepare("UPDATE posts SET likes=? WHERE id=?");
		$query->execute([$total_likes, $post_id]);
		$total_user_likes--;
		$user_likes = $con->prepare("UPDATE users SET num_likes=? WHERE username=?");
		$user_likes->execute([$total_user_likes, $user_liked]);
		$insert_user = $con->prepare("DELETE FROM likes WHERE username=? AND post_id=?");
		$insert_user->execute([$userLoggedIn, $post_id]);
	}

	//Check for previous likes
	$check_query = $con->prepare("SELECT * FROM likes WHERE username=? AND post_id=?");
	$check_query->execute([$userLoggedIn, $post_id]);
	$num_rows = $check_query->rowCount();

	if($num_rows > 0) {
		echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
				<input type="submit" class="comment_like" name="unlike_button" value="Unlike">
				<div class="like_value">
					'. $total_likes .' Likes
				</div>
			</form>
		';
	}
	else {
		echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
				<input type="submit" class="comment_like" name="like_button" value="Like">
				<div class="like_value">
					'. $total_likes .' Likes
				</div>
			</form>
		';
	}

	?>






</body>
</html>