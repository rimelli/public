<?php
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set("Europe/London");

$servername = "localhost";
$username = "root";
$password = "root";

$con = new PDO("mysql:host=$servername;dbname=dbtest", $username, $password);

?>