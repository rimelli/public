<?php


if(isset($_POST['update_child'])) {

	$fname_child = strip_tags($_POST['first_name_child']);
	$lname_child = strip_tags($_POST['last_name_child']);
	$gender = $_POST['gender_child'];

	$query = $con->prepare("INSERT INTO children VALUES (NULL, ?, ?, ?, ?, ?)");
	$query->execute([$userLoggedIn, $fname_child, $lname_child, $gender, 'no']);
	$last_id = $con->lastInsertId();

	echo json_encode(["child_id"=>$last_id,"message"=>"Child Added!"]);

}
else
	echo "";



//******************************************
// Remove child

if (isset($_GET['remove_child_id']) && is_numeric($_GET['remove_child_id'])){
	$check = $con->prepare("SELECT * FROM children WHERE child_id=? AND parent_id=? LIMIT 1");
	$check -> execute([$_GET['remove_child_id'], $userLoggedIn]);
	$child = $check->fetch();

	if ($child){
		$delete = $con->prepare("UPDATE children SET child_deleted=? WHERE child_id=? LIMIT 1");
		$delete -> execute(['yes', $_GET['remove_child_id']]);
		
		if ($delete -> rowCount()){
			header('Location: /settings.php');
		}
	}

}


?>

