<?php

//******************************************
// Remove gallery files

if (isset($_GET['remove_gallery_id']) && is_numeric($_GET['remove_gallery_id'])){
	$check = $con -> prepare("SELECT * FROM profile_galleries WHERE id=? AND user_id=? LIMIT 1");
	$check -> execute([$_GET['remove_gallery_id'], $userLoggedIn]);
	$gallery = $check->fetch();

	if ($gallery){
		if (unlink('assets/files/profile_galleries/'. $gallery['filename']. '.'. $gallery['type'])){
			$delete = $con->prepare("DELETE FROM profile_galleries WHERE id=? LIMIT 1");
			$delete -> execute([$_GET['remove_gallery_id']]);
			
			if ($delete -> rowCount()){
				echo 'deleted';
			}

		}

	}

}

//******************************************
// Add Gallery Files

if (isset($_FILES['galleries'])){

	$ret = [];

	// Allowed file mime-types below
	$allowed = [
		'image/png' => 'png', 
		'image/jpeg' => 'jpg', 
		'image/gif' => 'gif', 
		'application/pdf' => 'pdf'
	];

	for ($x = 0, $l = count($_FILES['galleries']['type']); $x < $l; $x++){
		if (isset($allowed[$_FILES['galleries']['type'][$x]])){
			$filename = uniqid('', true);
			if (move_uploaded_file($_FILES['galleries']['tmp_name'][$x], 'assets/files/profile_galleries/'. $filename. '.'. $allowed[$_FILES['galleries']['type'][$x]])){
				$query = $con->prepare("INSERT INTO profile_galleries (NULL, user_id, filename, original, mimetype, type, size) VALUES (?, ?, ?, ?, ?, ?)");
				$query->execute([$userLoggedIn, $filename, $_FILES['galleries']['name'][$x], $_FILES['galleries']['type'][$x], $allowed[$_FILES['galleries']['type'][$x]], $_FILES['galleries']['size'][$x]]);
				$id = $con->lastInsertId();

				if ($id){
					$ret[] = [$id, $_FILES['galleries']['name'][$x], $allowed[$_FILES['galleries']['type'][$x]]];
				}

			}

		}

	}

	echo json_encode(array_reverse($ret));

}

//******************************************


?>