<?php
session_start();

print_r($_SESSION);
$months= [];
for ($i = 0; $i < 6; $i++) {
     array_push($months,date(', F', strtotime("-$i month")));
  }

$dates = array_reverse($months);
print_r($dates);