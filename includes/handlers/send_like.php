<?php
	 
	require_once("../../config/config.php");
        //for notifications:
	require_once("../classes/User.php");
	require_once("../classes/Notification.php");
 
	$userLoggedIn = $_POST['userLoggedIn'];
	$id = $_POST['id'];
 
	//find information about the post:
	$get_likes = $con->prepare("SELECT likes, added_by FROM posts WHERE id=?");
	$get_likes->execute([$id]);
	$row = $get_likes->fetch();
	//declare total likes for the post:
	$total_likes = $row['likes'];
	//declare the author of the post:
	$user_liked = $row['added_by'];
 
	//find author in users:
	$user_details_query = $con->prepare("SELECT * FROM users WHERE user_id=?");
	$user_details_query->execute([$user_liked]);
	$row = $user_details_query->fetch();
	$total_user_likes = $row['num_likes'];
 
	//query likes:
	$is_liked = $con->prepare("SELECT * from likes WHERE user_id=? AND post_id=?");
	$is_liked->execute([$userLoggedIn, $id]);
	$num_rows = $is_liked->rowCount();
 
	if ($num_rows > 0) {
	    //remove like in posts:
	    $total_likes--;
	    $query = $con->prepare("UPDATE posts SET likes=? WHERE id=?");
	    $query->execute([$total_likes, $id]);
	    //remove like in users:
	    $total_user_likes--;
	    $user_likes = $con->prepare("UPDATE users SET num_likes=? WHERE user_id=?");
	    $user_likes->execute([$total_user_likes, $user_liked]);
		//delete like in likes:
	    $delete_like = $con->prepare("DELETE FROM likes WHERE user_id=? AND post_id=?");
	    $delete_like->execute([$userLoggedIn, $id]);
 
	} else {
	    //add 1 like to posts:
	    $total_likes++;
	    $query = $con->prepare("UPDATE posts SET likes=? WHERE id=?");
	    $query->execute([$total_likes, $id]);
	    //add 1 like to users:
	    $total_user_likes++;
	    $user_likes = $con->prepare("UPDATE users SET num_likes=? WHERE user_id=?");
	    $user_likes->execute([$total_user_likes, $user_liked]);
	    //add like to likes:
	    $insert_like = $con->prepare("INSERT INTO likes VALUES(NULL, ?, ?)");
	    $insert_like->execute([$userLoggedIn, $id]);
	    //insert notification
	    if($user_liked != $userLoggedIn){
	    		$notification = new Notification($con, $userLoggedIn);
	    		$notification->insertNotification($id, $user_liked, "like");
	    }
 
	}
 
?>