<?php

//******************************************
// Download attachments

if (isset($_GET['download_attachment_id']) && is_numeric($_GET['download_attachment_id'])){
	$check = $con -> prepare("SELECT * FROM profile_attachments WHERE id=? AND user_id=? LIMIT 1");
	$check -> execute([$_GET['download_attachment_id'], $userLoggedIn]);
	$attachment = $check->fetch();

	if ($attachment){
		header(sprintf('Content-Type: %s', $attachment['mimetype']));
		header(sprintf('Content-Disposition: attachment; filename=%s', $attachment['original']));
		header('Pragma: no-cache');
		readfile('assets/files/profile_attachments/'. $attachment['filename']. '.'. $attachment['type']);
		
	}else{
		echo 'File not found';

	}

}

//******************************************
// Remove attachments

if (isset($_GET['remove_attachment_id']) && is_numeric($_GET['remove_attachment_id'])){
	$check = $con -> prepare("SELECT * FROM profile_attachments WHERE id=? AND user_id=? LIMIT 1");
	$check -> execute([$_GET['remove_attachment_id'], $userLoggedIn]);
	$attachment = $check->fetch();

	if ($attachment){
		if (unlink('assets/files/profile_attachments/'. $attachment['filename']. '.'. $attachment['type'])){
			$delete = $con->prepare("DELETE FROM profile_attachments WHERE id=? LIMIT 1");
			$delete -> execute([$_GET['remove_attachment_id']]);
			
			if ($delete -> rowCount()){
				echo 'deleted';
			}

		}

	}

}

//******************************************
// Add attachments

if (isset($_FILES['attachments'])){

	$ret = [];

	// Allowed file mime-types below
	$allowed = [
		'image/png' => 'png', 
		'image/jpeg' => 'jpg', 
		'image/gif' => 'gif', 
		'application/pdf' => 'pdf',
		'application/msword' => 'doc',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx'
	];

	for ($x = 0, $l = count($_FILES['attachments']['type']); $x < $l; $x++){
		if (isset($allowed[$_FILES['attachments']['type'][$x]])){
			$filename = uniqid('', true);
			if (move_uploaded_file($_FILES['attachments']['tmp_name'][$x], 'assets/files/profile_attachments/'. $filename. '.'. $allowed[$_FILES['attachments']['type'][$x]])){
				$query = $con->prepare("INSERT INTO profile_attachments (user_id, filename, original, mimetype, type, size) VALUES (?, ?, ?, ?, ?, ?)");
				$query->execute([$userLoggedIn, $filename, $_FILES['attachments']['name'][$x], $_FILES['attachments']['type'][$x], $allowed[$_FILES['attachments']['type'][$x]], $_FILES['attachments']['size'][$x]]);
				$id = $con->lastInsertId();

				if ($id){
					$ret[] = [$id, $_FILES['attachments']['name'][$x], $allowed[$_FILES['attachments']['type'][$x]]];
				}

			}

		}

	}

	echo json_encode(array_reverse($ret));

}

//******************************************

if(isset($_POST['delete_prof_img'])) {

	$query = $con->prepare("UPDATE users SET profile_pic='assets/images/profile_pics/defaults/profileimg.png' WHERE user_id=?");
	$query->execute([$userLoggedIn]);
}


//******************************************


if(isset($_POST['update_details'])) {

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$username = $_POST['username'];

	//Nationality optiong tag 2 values
	$result = $_POST['nationality'];
    $result_explode = explode('|', $result);
    $nationality = trim($result_explode[0]);
    $country_name = trim($result_explode[1]);
    //end of nationality
	
	$about = $_POST['about'];		

	$email_check = $con->prepare("SELECT * FROM users WHERE email=?");
	$email_check->execute([$email]);
	$row = $email_check->fetch();
	$matched_user = $row['user_id'];
	$profile_type = $row['profile_type'];

	if($matched_user == "" || $matched_user == $userLoggedIn) {
		echo "Details updated!";

		if ($profile_type == 1) {
			$coach = isset($_POST['coach']) ? $_POST['coach'] : 'no';
			$scout = isset($_POST['scout']) ? $_POST['scout'] : 'no';
			$agent = isset($_POST['agent']) ? $_POST['agent'] : 'no';

			$query2 = $con->prepare("SELECT * FROM individuals WHERE user_id=?");
			$query2->execute([$userLoggedIn]);

			if($query2->rowCount() == 0) {
				$query1 = $con->prepare("INSERT INTO individuals (user_id, coach, scout, agent, birth, gender, country_based, city_based, county_based) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$query1->execute([$userLoggedIn, $coach, $scout, $agent, '0000-00-00', '', '', '', '']);

			}else{
				$query1 = $con->prepare("UPDATE individuals SET coach=?, scout=?, agent=? WHERE user_id=? LIMIT 1");
				$query1->execute([$coach, $scout, $agent, $userLoggedIn]);

			}			

			if ($coach == 'yes' || $scout == 'yes' || $agent == 'yes') {

				$query6 = $con->prepare("SELECT * FROM professionals WHERE user_id=?");
				$query6->execute([$matched_user]);

				if($query6->rowCount() == 0) {
					$query7 = $con->prepare("INSERT INTO professionals VALUES (NULL, ?)");
					$query7->execute([$matched_user]);
				}
			}

		}

		if ($profile_type == 2) {
			$pro_club = $_POST['pro_club'];
			$amateur_club = $_POST['amateur_club'];
			$academy = $_POST['academy'];

			$query2 = $con->prepare("UPDATE organisations SET pro_club=?, amateur_club=?, academy=? WHERE user_id=?");
			$query2->execute([$pro_club, $amateur_club, $academy, $userLoggedIn]);
		}

		$query3 = $con->prepare("UPDATE users SET first_name=?, last_name=?, email=?, username=?, about=? WHERE user_id=?");
		$query3->execute([$first_name, $last_name, $email, $username, $about, $userLoggedIn]);

		//  Nationality
		if (strlen($nationality) > 0 && strlen($country_name) > 0){

			$query4 = $con->prepare("SELECT id FROM nationalities WHERE user_id=?");
			$query4->execute([$userLoggedIn]);					

			if ($query4->rowCount() == 0){		
				$query8 = $con->prepare("INSERT INTO nationalities (user_id, nationality, country_name) VALUES (?, ?, ?)");
				$query8->execute([$userLoggedIn, $nationality, $country_name]);

			}else{
				$nationality_id = $query4->fetch();
				$query8 = $con->prepare("UPDATE nationalities SET nationality = ?, country_name = ? WHERE id = ? LIMIT 1");
				$query8->execute([$nationality, $country_name, $nationality_id['id']]);

			}

		}

	}
	else
		echo "That email is already in use!";
}
else
	echo "";


//******************************************


if(isset($_POST['update_individual'])) {

	$birth = $_POST['birth_date'];
	$gender = $_POST['gender'];
	$city_based = $_POST['city_based'];
	$city_explode = explode(',', $city_based);
	$city_name = trim($city_explode[0]);
	$county_name = trim($city_explode[1]);
	$country_based = $_POST['country_based'];

	if (empty($birth)) {
		$birth = '0000-00-00';
	}

	$email_check = $con->prepare("SELECT * FROM users WHERE email=?");
	$email_check->execute([$email]);
	$row = $email_check->fetch();
	$matched_user = $row['user_id'];

	if($matched_user == "" || $matched_user == $userLoggedIn) {
		echo "Details updated!";

		$query2 = $con->prepare("SELECT * FROM individuals WHERE user_id=?");
		$query2->execute([$userLoggedIn]);

		if($query2->rowCount() == 0) {
			$query1 = $con->prepare("INSERT INTO individuals (user_id, coach, scout, agent, birth, gender, country_based, city_based, county_based) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$query1->execute([$userLoggedIn, 'no', 'no', 'no', $birth, $gender, $country_based, $city_name, $county_name]);

		}else{
			$query = $con->prepare("UPDATE individuals SET birth=?, gender=?, country_based=?, city_based=?, county_based=? WHERE user_id=?");
			$query->execute([$birth, $gender, $country_based, $city_name, $county_name, $userLoggedIn]);

		}		
		
	}
	else
		echo "That email is already in use!";
}
else
	echo "";


//******************************************



if(isset($_POST['update_work'])) {

	$work_title = $_POST['pro_work_title'];
	$work_company = $_POST['pro_work_company'];
	$work_from_month = $_POST['pro_work_from_month'];
	$work_from_year = $_POST['pro_work_from_year'];
	$work_to_month = $_POST['pro_work_to_month'];
	$work_to_year = $_POST['pro_work_to_year'];
	$work_current = $_POST['pro_work_current'];
	$work_country = $_POST['pro_work_country'];
	$work_description = $_POST['pro_work_description'];

	if ($work_current == 'yes') {
		$work_to_month = '';
		$work_to_year = '';
	} elseif ($work_current == '') {
		$work_current = 'no';
	}

	$email_check = $con->prepare("SELECT * FROM users WHERE email=?");
	$email_check->execute([$email]);
	$row = $email_check->fetch();
	$matched_user = $row['user_id'];

	if($matched_user == "" || $matched_user == $userLoggedIn) {
		echo "Details updated!";
		
		$query = $con->prepare("INSERT INTO work_experience VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$query->execute([$userLoggedIn, $work_title, $work_company, $work_from_month, $work_from_year, $work_to_month, $work_to_year, $work_current, $work_country, $work_description]);

	}
	else
		echo "That email is already in use!";
}
else
	echo "";


//******************************************



//******************************************
//Updating Password

if(isset($_POST['update_password'])) {

	$old_password = strip_tags($_POST['old_password']);
	$new_password_1 = strip_tags($_POST['new_password_1']);
	$new_password_2 = strip_tags($_POST['new_password_2']);

	$password_query = $con->prepare("SELECT password FROM users WHERE user_id=?");
	$password_query->execute([$userLoggedIn]);
	$row = $password_query->fetch();	
	$db_password = $row['password'];

	if (password_verify($old_password, $db_password)) {

		if($new_password_1 == $new_password_2) {


			if(strlen($new_password_1) <= 4) {
				echo "Sorry, your password must be greater than 4 characters!";
			}
			else {				
				$password_query = $con->prepare("UPDATE users SET password=? WHERE user_id=? LIMIT 1");
				$password_query->execute([password_hash($new_password_1, PASSWORD_DEFAULT), $userLoggedIn]);				
				echo "Password has been changed!";
			}


		}
		else {
			echo "Your two new passwords need to match!";
		}

	}
	else {
		echo "The old password is incorrect!";
	}

}
else {
	echo "";
}


//******************************************
//Closing Account (Soft delete)

if(isset($_POST['close_account'])) {
	header("Location: close_account.php");
}


?>

