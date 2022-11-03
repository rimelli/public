<?php
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set("Europe/London");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upwork";

$con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Pusher Credentials

$cluster = 'ap2';
$auth_key = 'e3b4cff89826a7755f9f';
$secret = '3b5cb8ce69d9dbba7910';
$app_id = '1478386';
$chanel_name = 'football-app'

?>