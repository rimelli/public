<?php
require 'config/config.php';

if (isset($_SESSION['user_id']) && isset($_GET['type'])) {

	$what = 'day AS label, hits AS total';
	$where = null;
	$group = '';
	$ret = [];

	switch($_GET['type']){
		case 'today':
			$where = 'day = CURDATE()';
		break;
		case 'yesterday':
			$where = 'day = subdate(current_date, 1)';
		break;	
		case 'this_week':
			$where = 'day >= SUBDATE(CURDATE(), dayofweek(CURDATE()) - 1)';
		break;	
		case 'last_week':
			$where = 'YEARWEEK(day, 0) = YEARWEEK(CURDATE() - INTERVAL 1 WEEK, 0)';
		break;
		case 'this_month':
			$where = 'MONTH(day) = MONTH(CURRENT_DATE()) AND YEAR(day) = YEAR(CURRENT_DATE())';
		break;
		case 'last_month':
			$where = 'MONTH(day) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(day) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)';
		break;
		case 'last_3_months':
			$what = 'MONTHNAME(day) AS label, SUM(hits) AS total';
			$where = 'day >= LAST_DAY(NOW()) + INTERVAL 1 DAY - INTERVAL 3 MONTH';
			$group = 'GROUP BY MONTH(day)';
		break;
		case 'last_6_months':
			$what = 'MONTHNAME(day) AS label, SUM(hits) AS total';
			$where = 'day >= LAST_DAY(NOW()) + INTERVAL 1 DAY - INTERVAL 6 MONTH';
			$group = 'GROUP BY MONTH(day)';
		break;
		case 'this_year':
			$what = 'MONTHNAME(day) AS label, SUM(hits) AS total';
			$where = 'YEAR(day) = YEAR(CURRENT_DATE())';
			$group = 'GROUP BY MONTH(day)';
		break;
		case 'last_year':
			$what = 'DATE_FORMAT(day, "%M %Y") AS label, SUM(hits) AS total';
			$where = 'YEAR(day) = YEAR(CURRENT_DATE() - INTERVAL 1 YEAR)';
			$group = 'GROUP BY MONTH(day)';
		break;
	}

	if ($where){					
		$stats = $con -> prepare(sprintf('SELECT %s FROM stats WHERE %s AND user_id = ? %s ORDER BY day ASC', $what, $where, $group));
		$stats -> execute([$_SESSION['user_id']]);
		$ret = $stats -> fetchAll(PDO::FETCH_ASSOC);
	}

	echo json_encode($ret);
	
}else {
	header("Location: home.php");
	exit();
}
?>