<?php
session_start();

print_r($_SESSION);
$months= [];
$ddate = "2022-03-04";
$date = new DateTime($ddate);
$week = $date->format("W");
echo "Weeknummer: $week";
// for ($i = 0; $i < 6; $i++) {
//      array_push($months,date('F', strtotime("-$i Month")));
//   }

// $dates = array_reverse($months);
// print_r($dates);