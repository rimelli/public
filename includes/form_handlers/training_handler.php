<?php
require 'config/config.php';



if (isset($_POST['create_session_cond'])){
	$query = $con->prepare("SELECT id FROM training WHERE tr_category=? ORDER BY RAND() LIMIT 5");
	$query->execute(['conditioning']);
	$res = $query->fetchAll();

	$drills = array();

	foreach ($res as $drill) {
		$drills[] = $drill['id'];
	}

	$sql = $con->prepare("INSERT INTO training_sessions VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$sql->execute([$userLoggedIn, 'Conditioning', $drills[0], 'no', $drills[1], 'no', $drills[2], 'no', $drills[3], 'no', $drills[4], 'no', 'no', '0000-00-00', 'no']);
	$last_id = $con->lastInsertId();

	echo json_encode(["sess_id"=>$last_id,"message"=>"Session created!"]);
}


//******************************************

if (isset($_POST['cond_button'])) {

	$level = strip_tags($_POST['cond-radio']);

	$userLoggedIn = $_SESSION['user_id'];

	$query = $con->prepare("INSERT INTO ratings VALUES (NULL, ?, ?)");
	$query->execute([$userLoggedIn, $level]);

	echo json_encode(array('status' => 'success', 'message' => 'Level Submitted!', 'url' => 'training.php'));

}


?>