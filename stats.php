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
			$what = 'MONTHNAME(day) AS label, SUM(hits) AS total';
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
	}
	// print_r($ret);
	// exit();
	echo json_encode($ret);
	
}else {
	header("Location: home.php");
	exit();
}
?>