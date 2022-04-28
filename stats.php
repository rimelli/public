<?php
require 'config/config.php';

function sort_daily($ret){
	$s=[];
	foreach($ret as $r){
		$s[$r['label']]=$r['total'];
	}
	for ($i = 0; $i < 6; $i++) {
		$d=date('l', strtotime("-$i day"));
		if(!array_key_exists($d,$s)){
			$s[$d]=0;
		}
	 }

	 $e=[];
	 foreach($s as $d=>$v){
		 $r=['label'=>$d,"total"=>$v];
		 array_push($e,$r);
	 }
	 $dayOrder = [
		'Saturday'  => 1,
		'Sunday'    => 2,
		'Monday'    => 3,
		'Tuesday'   => 4,
		'Wednesday' => 5,
		'Thursday'  => 6,
		'Friday'    => 7,
	];
	$ret=$e;
	usort($ret,
		function ($a, $b) use ($dayOrder) {
			return $dayOrder[$a['label']] > $dayOrder[$b['label']];
		});
	return $ret;
}
function weekNum($date = false) {
    $day = $date ? strtotime($date) : time();
    if($res = ceil((date("z", $day) + 1 - date("w", $day)) / 7)){
        return $res;
    }
    $ldly = strtotime((date("Y", $day)-1)."-12-31"); //last day last year
    return ceil((date("z", $ldly ) + 1 - date("w", $ldly )) / 7);
}

function sort_weekly($ret){
	$s=[];
	foreach($ret as $r){
		$s[$r['label']]=$r['total'];
	}
	for($i=0;$i<4;$i++){
		$w="Week ".weekNum(date('d-m-Y',strtotime("-".$i." week")))." / ".date('Y',strtotime("-".$i." week"));
		if(!array_key_exists($w,$s)){
			$s[$w]=0;
		}
	}
	$e=[];
	foreach($s as $d=>$v){
		$r=['label'=>$d,"total"=>$v];
		array_push($e,$r);
	}
	sort($e);
	return $e;
}

function sort_montly($ret){
	$s=[];
	foreach($ret as $r){
		$s[$r['label']]=$r['total'];
	}
	for($i=0;$i<6;$i++){
		$m=date('F',strtotime("-".$i." month"))." ".date('Y',strtotime("-".$i." month"));
		if(!array_key_exists($m,$s)){
			$s[$m]=0;
		}
	}
	uksort($s, function($a1, $a2) {
        $a = strtotime($a1);
        $b = strtotime($a2);

        return $a - $b;
    });
	$e=[];
	foreach($s as $d=>$v){
		$r=['label'=>$d,"total"=>$v];
		array_push($e,$r);
	}

	return $e;
}

function sort_yearly($ret){
	$s=[];
	foreach($ret as $r){
		$s[$r['label']]=$r['total'];
	}
	for($i=0;$i<3;$i++){
		$y=date('Y',strtotime("-".$i." Year"));
		if(!array_key_exists($y,$s)){
			$s[$y]=0;
		}
	}
	$e=[];
	foreach($s as $d=>$v){
		$r=['label'=>$d,"total"=>$v];
		array_push($e,$r);
	}
	sort($e);
	return $e;
}
if (isset($_SESSION['user_id']) && isset($_GET['type'])) {

	$what = 'DAYNAME(day) AS label, hits AS total';
	$where = null;
	$group = '';
	$ret = [];

	switch($_GET['type']){	
		case 'daily':
			$where = 'day >= SUBDATE(CURDATE(), INTERVAL 6 DAY) AND day<=CURDATE()';
		break;	
		case 'weekly':
			$what = 'CONCAT("Week ", WEEK(day)," / ", YEAR(day)) AS label, SUM(hits) AS total';
			$where = 'YEARWEEK(day, 0) >= YEARWEEK(CURDATE() - INTERVAL 4 WEEK, 0) AND YEARWEEK(DAY)<=YEARWEEK(CURDATE())';
			$group = 'GROUP BY YEARWEEK(day)';
		break;
		case 'monthly':
			$what = 'CONCAT(MONTHNAME(day)," ",YEAR(day)) AS label, SUM(hits) AS total';
			$where = 'day >= LAST_DAY(NOW()) + INTERVAL 1 DAY - INTERVAL 6 MONTH';
			$group = 'GROUP BY MONTH(day)';
		break;
		case 'yearly':
			$what = 'YEAR(day) AS label, SUM(hits) AS total';
			$where = 'YEAR(day) >= YEAR(CURRENT_DATE() - INTERVAL 3 YEAR)';
			$group = 'GROUP BY YEAR(day)';
		break;
	}

	if ($where){					
		$stats = $con -> prepare(sprintf('SELECT %s FROM stats WHERE %s AND user_id = ? %s ORDER BY day ASC', $what, $where, $group));
		$stats -> execute([$_SESSION['user_id']]);
		$ret = $stats -> fetchAll(PDO::FETCH_ASSOC);
	}

	switch($_GET['type']){
		case 'daily':
			$ret=sort_daily($ret);
		break;
		case 'weekly':
			$ret=sort_weekly($ret);
		break;	 
		case 'monthly':
			$ret=sort_montly($ret);
		break;  
		case 'yearly':
			$ret=sort_yearly($ret);
		break; 
	}
	// print_r($ret);
	// exit();
	echo json_encode($ret);
	
}else {
	header("Location: home.php");
	exit();
}
?>