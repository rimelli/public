<?php
include("config/config.php");
var_dump($con);die;
$make_offline_account = $con->prepare("UPDATE users SET is_online=false WHERE id=?");
$make_offline_account->execute([$_GET['user_id']]);

session_start();
session_destroy();
header("Location: ../../home.php");