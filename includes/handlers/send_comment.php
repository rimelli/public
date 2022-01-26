<?php
 
require_once("../../config/config.php");
require_once("../classes/User.php");
require_once("../classes/Post.php");
require_once("../classes/Notification.php");
 
$userLoggedIn = $_POST['userLoggedIn'];
$commentText = $_POST['commentText'];
$id = $_POST['id'];
 
$get_added_by = $con->prepare("SELECT added_by, user_to FROM posts WHERE id=?");
$get_added_by->execute([$id]);
$find_users = $get_added_by->fetch();
$post_author = $find_users['added_by'];
$user_to = $find_users['user_to'];
 
$post = new Post($con, $userLoggedIn);
$post->sendComment($post_author, $commentText, $id, $user_to);