<?php
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set("Europe/London");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upwork";

$con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

?>