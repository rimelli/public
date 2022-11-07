<?php

if (isset($_POST['create_session_cond'])){
	$query = $con->prepare("SELECT id FROM training WHERE tr_category=? LIMIT 5");
	$query->execute(['conditioning']);
	$res = $query->fetchAll();

	$drills = array();

	foreach ($res as $drill) {
		$drills[] = $drill['id'];
	}
	$sql = $con->prepare("INSERT INTO training_sessions VALUES ( NULL,?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$sql->execute([$userLoggedIn, 'conditioning', $drills[0], $drills[1], $drills[2], $drills[3], $drills[4], 'no', 'no']);
	$last_id = $con->lastInsertId();

	echo json_encode(["sess_id"=>$last_id,"message"=>"Session created!"]);
}


?>