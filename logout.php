<?php
include("config/config.php");
$make_offline_account = $con->prepare("UPDATE users SET is_online=false WHERE user_id=?");
$make_offline_account->execute([(int)$_GET['user_id']]);

session_start();
session_destroy();
header("Location: home.php");