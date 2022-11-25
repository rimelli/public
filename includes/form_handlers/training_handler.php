<?php
require dirname(__FILE__, 3) . "/config/config.php";
require dirname(__FILE__, 1) ."/sess_handler.php";

function getCompletedSession($con, $userLoggedIn,$session_level){
	$q = $con->prepare("SELECT * FROM training_sessions WHERE user_id=? and session_level=?");
	$q->execute([$userLoggedIn,$session_level]);
	$sess_result = $q->fetchAll();
	$sess_count = $q->rowCount();
	return $sess_count;
}

if (isset($_POST['create_session_cond'])) {
	$q = $con->prepare("SELECT * FROM training_sessions WHERE user_id=? and session_completed='yes'");
	$q->execute([$userLoggedIn]);
	$rating_result = $q->fetchAll();
	$rating_count = $q->rowCount();

	if ($rating_count < 10) {
		$q = $con->prepare("SELECT * FROM ratings WHERE user_id=?");
		$q->execute([$userLoggedIn]);
		$rating_result = $q->fetch(PDO::FETCH_ASSOC);
		$r_cond = $rating_result['r_conditioning'];

		if ($r_cond < 3) {
			$tr_level = 1;
		} elseif ($r_cond == 3 || $r_cond < 4) {
			$tr_level = 3;
		} else {
			$tr_level = 5;
		}
	}else{
		$rating= getRating($con,$userLoggedIn);
		if($rating>3 && getCompletedSession($con,$userLoggedIn,3)>=10){
			$tr_level=5;
		}else{
			$tr_level=3;
		}
	}
	$query = $con->prepare("SELECT id FROM training WHERE tr_category=? AND tr_level=? ORDER BY RAND() LIMIT 5");
	$query->execute(['conditioning', $tr_level]);
	$res = $query->fetchAll();

	$drills = array();

	foreach ($res as $drill) {
		$drills[] = $drill['id'];
	}

	$sql = $con->prepare("INSERT INTO training_sessions VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$sql->execute([$userLoggedIn, 'Conditioning', $tr_level, $drills[0], $drills[1], $drills[2], $drills[3], $drills[4], 0, 'no', '0000-00-00', 'no']);
	$last_id = $con->lastInsertId();

	echo json_encode(["sess_id" => $last_id, "message" => "Session created!"]);
}


//******************************************

if (isset($_POST['cond_button'])) {

	$level = strip_tags($_POST['cond-radio']);

	$userLoggedIn = $_SESSION['user_id'];

	$q = $con->prepare("SELECT * FROM ratings WHERE user_id=?");
	$q->execute([$userLoggedIn]);
	$r = $q->fetch();
	if ($r) {
		$query = $con->prepare("UPDATE ratings SET r_conditioning=:tr_level WHERE user_id=:userid");
		$query->execute([":tr_level" => $level, ":userid" => $userLoggedIn]);

		echo json_encode(array('status' => 'success', 'message' => 'Level Updated!', 'url' => 'training.php'));
	} else {
		$query = $con->prepare("INSERT INTO ratings VALUES (NULL, ?, ?)");
		$query->execute([$userLoggedIn, $level]);

		echo json_encode(array('status' => 'success', 'message' => 'Level Submitted!', 'url' => 'training.php'));
	}
}

if (isset($_POST['cond_btn_2'])) {

	$level = strip_tags($_POST['tr-radio']);

	$userLoggedIn = $_SESSION['user_id'];
	$q = $con->prepare("SELECT * FROM ratings WHERE user_id=?");
	$q->execute([$userLoggedIn]);
	$r = $q->fetch();
	if ($r) {
		$query = $con->prepare("UPDATE ratings SET r_conditioning=:tr_level WHERE user_id=:userid");
		$query->execute([":tr_level" => $level, ":userid" => $userLoggedIn]);

		echo json_encode(array('status' => 'success', 'message' => 'Level Updated!', 'url' => 'training.php'));
	} else {
		$query = $con->prepare("INSERT INTO ratings VALUES (NULL, ?, ?)");
		$query->execute([$userLoggedIn, $level]);

		echo json_encode(array('status' => 'success', 'message' => 'Level Submitted!', 'url' => 'training.php'));
	}
}
