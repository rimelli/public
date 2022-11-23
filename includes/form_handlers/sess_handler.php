<?php
require dirname(__FILE__, 3) . "/config/config.php";

$userLoggedIn = $_SESSION['user_id'];

if (isset($_POST['sess_id'])&& isset($_POST['drill_id']) && isset($_POST['sess_complete'])){
	$drill=htmlspecialchars(strip_tags(trim($_POST['drill_id'])));
	$sess_complete=htmlspecialchars(strip_tags(trim($_POST['sess_complete'])));
	$sess_id=htmlspecialchars(strip_tags(trim($_POST['sess_id'])));
	if($sess_complete=='yes'){
		$query='SELECT * FROM training_sessions WHERE id=:sess_id AND user_id=:user_id';
		$q1 = $con->prepare($query);
		$q1->execute([':sess_id'=>$sess_id,':user_id'=>$userLoggedIn]);
		$r= $q1->fetch(PDO::FETCH_ASSOC);
		if($r['drills_completed']<5){
			$drills=$r['drills_completed']+1;
		}else{
			$drills=5;
		}
		$query="UPDATE training_sessions SET drills_completed=:drill_complete WHERE id=:sess_id AND user_id=:user_id;";
		$q = $con->prepare($query);
		$r=$q->execute([':drill_complete'=>$drills,':sess_id'=>$sess_id,':user_id'=>$userLoggedIn]);
	
		if($r){
			echo json_encode(["message"=>"Session Drill Updated!"]);
		}
	}else{
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
	$query="SELECT session_level, drills_completed FROM training_sessions WHERE user_id=? ORDER BY id DESC LIMIT 10";
	$q = $con->prepare($query);
	$q->execute([$userLoggedIn]);
	$r=$q->fetchAll(PDO::FETCH_DEFAULT);
	$rating=0.00;
	foreach($r as $e){
		// echo '<pre>';
		// print_r($e);
		// echo '</pre>';
		if($e['session_level']==1){
			$rating+=floatval(0.06*$e[1]);
			echo $rating;
		}elseif($e['session_level']==3){
			$rating+=floatval(0.08*$e[1]);
			echo $e['session_level'];
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