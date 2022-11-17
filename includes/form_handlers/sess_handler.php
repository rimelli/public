<?php
require dirname(__FILE__, 3) . "/config/config.php";

$userLoggedIn = $_SESSION['user_id'];

if (isset($_POST['sess_id'])&& isset($_POST['drill_id']) && isset($_POST['sess_complete'])){
	$drill=htmlspecialchars(strip_tags(trim($_POST['drill_id'])));
	$sess_complete=htmlspecialchars(strip_tags(trim($_POST['sess_complete'])));
	$sess_id=htmlspecialchars(strip_tags(trim($_POST['sess_id'])));
	$query="UPDATE training_sessions SET ".$drill."=:drill_complete WHERE id=:sess_id AND user_id=:user_id;";
	$q = $con->prepare($query);
	$r=$q->execute([':drill_complete'=>$sess_complete,':sess_id'=>$sess_id,':user_id'=>$userLoggedIn]);

	if($r){
		echo json_encode(["message"=>"Session Drill Updated!"]);
	}
}
if (isset($_POST['sess_id'])&& isset($_POST['finish_session_cond'])){
	$sess_id=htmlspecialchars(strip_tags(trim($_POST['sess_id'])));
	$query="UPDATE training_sessions SET session_completed=:sess_complete WHERE id=:sess_id AND user_id=:user_id;";
	$q = $con->prepare($query);
	$r=$q->execute([':sess_complete'=>"yes",':sess_id'=>$sess_id,':user_id'=>$userLoggedIn]);

	if($r){
		echo json_encode(["message"=>"Session Marked as Completed!"]);
	}
}

function getRating($con,$userLoggedIn){
	$query="SELECT tr_level, COUNT(*) FROM training_sessions WHERE user_id=? AND session_completed='yes' GROUP BY tr_level ";
	$q = $con->prepare($query);
	$q->execute([$userLoggedIn]);
	$r=$q->fetchAll(PDO::FETCH_DEFAULT);
	$rating=0.00;
	foreach($r as $e){
		print_r($e);
		if($e['tr_level']==1){
			$rating+=floatval(0.06*$e[1]);
			echo $rating;
		}elseif($e['tr_level']==3){
			$rating+=floatval(0.08*$e[1]);
			echo $e['tr_level'];
		}else{
			$rating+=floatval(0.1*$e[1]);
		}
	}
	return $rating;
}

// echo '<pre>';
// print_r($rating);
// The Query is here if want to calculate rating based on each drill.
// $query="with v as (
//     select 'yes' Value union all select 'no'
// )
// select value,
//     Sum(case when drill_1_completed=value then 1 else 0 end) drill_1_completed,
//     Sum(case when drill_2_completed=value then 1 else 0 end) drill_2_completed,
//     Sum(case when drill_3_completed=value then 1 else 0 end) drill_3_completed,
// 	Sum(case when drill_4_completed=value then 1 else 0 end) drill_4_completed,
//     Sum(case when drill_5_completed=value then 1 else 0 end) drill_5_completed
// from v cross join training_sessions WHERE user_id=? AND tr_level=?
// group by value";
// 			$q = $con->prepare($query);
// 		$q->execute([$userLoggedIn,5]);
// 		$r=$q->fetchAll(PDO::FETCH_ASSOC);
// 		echo'<pre>';
// 		print_r($r);


?>