<?php
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set("Europe/London");

$servername = "localhost";
$username = "root";
$password = "root";

$con = new PDO("mysql:host=$servername;dbname=dbtest", $username, $password);
$master_key='8facf657e6e83855d369ce208e1cb209bd64ea6226845713f218b4405762233e';
?>