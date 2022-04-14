<?php
require("../config/config.php");
include("../includes/classes/User.php");


if(!isset($_SESSION['user_id'])){
    header('Location: home.php');
    exit;
}

function int_only($string)
{
    $string = preg_replace('/[^\d+$]/', "", $string);
    return $string;
}

$userLoggedIn = $_SESSION['user_id'];

if(isset($_POST["add_following"]) && !empty($_POST['add_following'])){
    $user_id=int_only($_POST['add_following']);
	$user = new User($con, $userLoggedIn);
	$user->sendFollow($user_id);
    echo "Followed Successdully";
}

if(isset($_POST["remove_following"]) && !empty($_POST['remove_following'])){
    $user_id=int_only($_POST['remove_following']);
	$user = new User($con, $userLoggedIn);
	$user->removeFollowing($user_id);
    echo "Unfollowed Successfully";
}